import { Dispatch, MiddlewareAPI } from 'redux';
import {AppActionTypes, SET_TIMER, UPDATE_TIMER_DATA} from '../actions/interfaces';
import {IAppState, TimerStorage} from '../interfaces';

const now = () => Math.round((new Date()).getTime() / 1000);

export const timerMw = (timerStorage: TimerStorage) => (mw: MiddlewareAPI<Dispatch<AppActionTypes>, IAppState>) => (next: Dispatch<AppActionTypes>) => (action: AppActionTypes) => {
  switch (action.type) {
    case SET_TIMER:
      if (action.payload.waiting) {
        if (timerStorage.timer) {
          timerStorage.clearInterval(timerStorage.timer);
        }
        timerStorage.timer = null;
        next({ type: UPDATE_TIMER_DATA, payload: {
          ...action.payload,
          lastUpdateTimestamp: undefined
        }});
      } else {
        if (timerStorage.timer) {
          timerStorage.clearInterval(timerStorage.timer);
        }

        timerStorage.timer = timerStorage.setInterval(() => {
          const gameEnded = !mw.getState().currentSessionHash;
          const timerNotRequired = !mw.getState().gameConfig.useTimer;
          if (gameEnded || timerNotRequired) {
            if (timerStorage.timer) {
              timerStorage.clearInterval(timerStorage.timer);
            }
            return;
          }
          // Calc delta to support mobile suspending with js timers stopping
          let delta = (now() - mw.getState().timer.lastUpdateTimestamp);
          let timeRemaining = mw.getState().timer.lastUpdateSecondsRemaining - delta;
          if (timeRemaining <= 0) {
            // timer is finished
            next({ type: UPDATE_TIMER_DATA, payload: {
              ...action.payload,
              lastUpdateTimestamp: now(),
              secondsRemaining: 0
            }});
            if (timerStorage.timer) {
              timerStorage.clearInterval(timerStorage.timer);
            }
            timerStorage.timer = null;
          } else {
            next({ type: UPDATE_TIMER_DATA, payload: {
              ...action.payload,
              lastUpdateTimestamp: now(),
              secondsRemaining: timeRemaining
            }});
          }
        }, 1000);

        next({ type: UPDATE_TIMER_DATA, payload: {
          ...action.payload,
          lastUpdateTimestamp: now()
        }});
      }
      break;
    default:
  }

  return next(action);
};
