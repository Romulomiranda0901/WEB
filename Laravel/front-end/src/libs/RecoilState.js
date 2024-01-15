import { atom, selector } from 'recoil';
import { recoilPersist  } from 'recoil-persist';

const { persistAtom } = recoilPersist()

export const usuarioAtom = atom({
    key: 'usuarioAtom',
    default: null,
    effects_UNSTABLE: [persistAtom],

});

export const getUsuario = selector({
    key: 'get-usuario',
    get: ({ get }) => get(usuarioAtom),
});

export const reciboAtom = atom({
    key: 'reciboAtom', // Corregir la clave aquí
    default: null,
    effects_UNSTABLE: [persistAtom],
});

export const getRecibo = selector({
    key: 'get-recibo',
    get: ({ get }) => get(reciboAtom),
});
