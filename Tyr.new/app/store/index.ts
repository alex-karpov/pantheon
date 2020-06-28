import { createStore, applyMiddleware, Store as ReduxStore, compose } from 'redux';
import { screenManageReducer } from './reducers/screenManageReducer';
import { mimirClient } from './middlewares/mimirClient';
import { RiichiApiService } from '#/services/riichiApi';
import { mimirReducer } from './reducers/mimirReducer';
import { outcomeReducer } from './reducers/outcomeReducer';
import { metrika } from './middlewares/metrika';
import { history } from './middlewares/history';
import { MetrikaService } from '#/services/metrika';
import { timerReducer } from './reducers/timerReducer';
import { timerMw } from './middlewares/timer';
import { IAppState, TimerStorage } from './interfaces';
import { commonReducer } from './reducers/commonReducer';
import { persistentMw } from './middlewares/persistent';
import { IDB } from '#/services/idb';
import reduceReducers from 'reduce-reducers';
import { initialState } from './state';
import { logging } from './middlewares/logging';
import { I18nService } from '#/services/i18n';
import { yaku } from './middlewares/yaku';

export class Store {
  private onUpdate: ((state: IAppState) => void) | undefined;
  private store: ReduxStore<IAppState>;
  private readonly timerSt: TimerStorage;

  constructor(i18n: I18nService) {
    this.timerSt = {
      timer: null,
      setInterval: window.setInterval,
      clearInterval: window.clearInterval
    };
    const reducer = reduceReducers(initialState,
      commonReducer,
      screenManageReducer,
      outcomeReducer,
      mimirReducer,
      timerReducer
    );
    const metrikaService = new MetrikaService();
    const idb = new IDB(metrikaService);
    const middleware = applyMiddleware(
      logging(`⇨ [middlewares]`),
      mimirClient(new RiichiApiService()),
      metrika(metrikaService),
      history(),
      timerMw(this.timerSt),
      persistentMw(idb),
      yaku(i18n),
      logging(`⇨ [reducers]`),
    );
    const composeEnhancers = window.__REDUX_DEVTOOLS_EXTENSION_COMPOSE__ &&
      window.__REDUX_DEVTOOLS_EXTENSION_COMPOSE__({ trace: true, traceLimit: 25 }) || compose;
    this.store = createStore(reducer, composeEnhancers(middleware)) as unknown as ReduxStore<IAppState>; // TODO: proper types
  }

  public subscribe(onUpdate: (state: IAppState) => void) {
    this.onUpdate = onUpdate;
    this.store.subscribe(() => this.onUpdate && this.onUpdate(this.store.getState()));
  }

  get dispatch() { return this.store.dispatch; }

  public get redux(): ReduxStore<IAppState> {
    return this.store;
  }
}
