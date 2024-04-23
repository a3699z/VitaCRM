import { forwardRef, useEffect, useRef } from 'react';

export default function DayInput({ day, index, onChange }) {
    return (
        <input
            className="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
            id={`days.${index}.date`}
            type="date"
            placeholder="Date"
            value={day.date}
            onChange={(e) => onChange(index, e.target.value)}
        />
    );
}
