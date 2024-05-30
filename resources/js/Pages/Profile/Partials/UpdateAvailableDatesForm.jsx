import InputError from '@/Components/InputError';
import InputLabel from '@/Components/InputLabel';
import PrimaryButton from '@/Components/PrimaryButton';
import DayInput from '@/Components/DayInput';
import HourInput from '@/Components/HourInput';
import {  useForm, usePage } from '@inertiajs/react';

export default function UpdateProfileInformation({ mustVerifyEmail, status, className = '' }) {
    const user = usePage().props.auth.user;
    console.log(user.available_dates);

    const { data, setData, patch, errors, processing, recentlySuccessful } = useForm({
        dates : user.available_dates ? user.available_dates.map((date) => {
            return {
                date: date.date,
                hours: date.hours? date.hours.map((hour) => {
                    return hour
                }) : []
            }
        })  : [{date: '', hours: []}]
    });


    // console.log(dates)

    const submit = (e) => {
        e.preventDefault();

        patch(route('dates.update'));

    };
    // every employee has a list of available dates and every date has hours on that date
    // so we need to loop through the dates and hours and update them
    return (
        <section className={className}>
            <header>
                <h2 className="text-lg font-medium text-gray-900">Available Dates</h2>

                <p className="mt-1 text-sm text-gray-600">
                    Update your available dates.
                </p>
            </header>

            <form onSubmit={submit} className="mt-6 space-y-6">
                {data.dates.map((date, index) => (
                    <div key={index} className="flex items-center space-x-4">
                        <div>
                            <InputLabel htmlFor={`dates.${index}.date`} value="Date" />

                            <DayInput
                                day={date}
                                index={index}
                                onChange={(i, value) => {
                                    const newDates = data.dates.map((d, di) => {
                                        if (index === di) {
                                            return { ...d, date: value };
                                        }

                                        return d;
                                    });

                                    setData('dates', newDates);
                                }}
                            />

                            <InputError className="mt-2" message={errors[`dates.${index}.date`]} />
                        </div>
                        {/* loop through hours */}
                        {date.hours.map((hour, hourIndex) => (
                            <div key={hourIndex}>
                                <InputLabel htmlFor={`dates.${index}.hours.${hourIndex}.hour`} value="Hour" />

                                <HourInput
                                    hour={hour}
                                    index={hourIndex}
                                    dateIndex={index}
                                    onChange={(hi, value) => {
                                        const newDates = data.dates.map((d, i) => {
                                            if (index === i) {
                                                return { ...d, hours: d.hours.map((h, hi) => {
                                                    if (hourIndex === hi) {
                                                        return value;
                                                    }

                                                    return h;
                                                }) };
                                            }

                                            return d;
                                        });

                                        setData('dates', newDates);
                                    }}
                                />

                                <InputError className="mt-2" message={errors[`dates.${index}.hours.${hourIndex}.hour`]} />
                                {/* delelete hour */}
                                <button
                                    type="button"
                                    onClick={() => {
                                        const newDates = data.dates.map((d, i) => {
                                            if (index === i) {
                                                return { ...d, hours: d.hours.filter((h, hi) => hi !== hourIndex) };
                                            }

                                            return d;
                                        });

                                        setData('dates', newDates);
                                    }}
                                    className="mt-4 bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline"
                                >Delete Hour</button>

                            </div>
                        ))}

                        {/* add hour button  */}
                        <button
                            type="button"
                            onClick={() => {
                                const newDates = data.dates.map((d, i) => {
                                    if (index === i) {
                                        return { ...d, hours: [...d.hours, { hour: '' }] };
                                    }

                                    return d;
                                });

                                setData('dates', newDates);
                            }}
                            className="mt-4 bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline"
                        >Add Hour</button>
                        {/* delete day */}
                        <button
                            type="button"
                            onClick={() => {
                                const newDates = data.dates.filter((d, i) => index !== i);

                                setData('dates', newDates);
                            }}
                            className="mt-4 bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline"
                        >Delete Day</button>
                    </div>
                ))}
                {/* add day button */}
                <button
                    type="button"
                    onClick={() => {
                        setData('dates', [...data.dates, { date: '', hours: [{ hour: '' }] }]);
                    }}
                    className="mt-4 bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline"
                >Add Day</button>

                <div className="flex justify-end">
                    <PrimaryButton className="ml-4" processing={processing}>
                        Update
                    </PrimaryButton>
                </div>
            </form>
        </section>
    )
}
