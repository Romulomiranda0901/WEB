// src/app/components/HelloMessage.tsx
import React from 'react';

interface Props {
    name: string;
}

const HelloMessage: React.FC<Props> = ({ name }) => {
    return <div>Hello, {name}!</div>;
};

export default HelloMessage;
