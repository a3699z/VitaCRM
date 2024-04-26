import InputError from '@/Components/InputError';
import InputLabel from '@/Components/InputLabel';
import PrimaryButton from '@/Components/PrimaryButton';
import DayInput from '@/Components/DayInput';
import HourInput from '@/Components/HourInput';
import { Link, useForm, usePage } from '@inertiajs/react';
import { Transition } from '@headlessui/react';

export default function OtherPatientInfo({ className = '' }) {
    const user = usePage().props.auth.user;

    const { data, setData, patch, errors, processing, recentlySuccessful } = useForm({
        legal_guardian: user.legal_guardian ? user.legal_guardian : '',
        level_of_care: user.level_of_care ? user.level_of_care : '',
    });


    // console.log(dates)

    const submit = (e) => {
        e.preventDefault();

        patch(route('patientinfo.update'));
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
                <div>
                    <InputLabel htmlFor={`legal_guardian`} value="Legal Guardian" />

                    <input
                        id={`legal_guardian`}
                        type="text"
                        className="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"
                        value={data.legal_guardian}
                        onChange={(e) => setData('legal_guardian', e.target.value)}
                    />

                    <InputError className="mt-2" message={errors.legal_guardian} />
                </div>

                <div>
                    <InputLabel htmlFor={`level_of_care`} value="Level of Care" />

                    <input
                        id={`level_of_care`}
                        type="text"
                        className="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"
                        value={data.level_of_care}
                        onChange={(e) => setData('level_of_care', e.target.value)}
                    />

                    <InputError className="mt-2" message={errors.level_of_care} />
                </div>



                <div className="flex justify-end">
                    <PrimaryButton className="ml-4" processing={processing}>
                        Update
                    </PrimaryButton>
                </div>
            </form>
        </section>
    )
}
