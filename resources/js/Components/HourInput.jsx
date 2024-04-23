import { forwardRef, useEffect, useRef } from 'react';


export default function HourInput({ hour, index, dateIndex, onChange }) {
    return (
        <input
            className="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
            id={`hours.${dateIndex}${index}.hour`}
            type="time"
            placeholder="Hour"
            value={hour.hour}
            onChange={(e) => onChange(index, e.target.value)}
        />
    );
}
