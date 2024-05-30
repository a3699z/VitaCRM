import InputError from '@/Components/InputError';
import InputLabel from '@/Components/InputLabel';
import PrimaryButton from '@/Components/PrimaryButton';
import {  useForm, usePage } from '@inertiajs/react';

export default function ProfessionalDateForm({ className = '' }) {
    const user = usePage().props.auth.user;
    console.log(user.available_dates);
    // Professional data (training profession, completion date, lifetime employee number (LBNR), job scope, organization)


    const { data, setData, patch, errors, processing, recentlySuccessful } = useForm({
        training_profession: user.training_profession ? user.training_profession : '',
        training_completion_date: user.completion_date ? user.completion_date : '',
        lifetime_employee_number: user.lifetime_employee_number ? user.lifetime_employee_number : '',
        job_scope: user.job_scope ? user.job_scope : '',
        organization: user.organization ? user.organization : '',

    });


    // console.log(dates)

    const submit = (e) => {
        e.preventDefault();

        patch(route('professional.update'));
    };
    // every employee has a list of available dates and every date has hours on that date
    // so we need to loop through the dates and hours and update them
    return (
        <section className={className}>
            <header>
                <h2 className="text-lg font-medium text-gray-900">Available Dates</h2>

                <p className="mt-1 text-sm text-gray-600">
                    Update your professional
                </p>
            </header>

            <form onSubmit={submit} className="mt-6 space-y-6">
                <div>
                    <InputLabel htmlFor={`training_profession`} value="Training Profession" />

                    <input
                        id={`training_profession`}
                        type="text"
                        className="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"
                        value={data.training_profession}
                        onChange={(e) => setData('training_profession', e.target.value)}
                    />

                    <InputError className="mt-2" message={errors.training_profession} />
                </div>

                <div>
                    <InputLabel htmlFor={`training_completion_date`} value="Training Completion Date" />

                    <input
                        id={`training_completion_date`}
                        type="date"
                        className="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"
                        value={data.training_completion_date}
                        onChange={(e) => setData('training_completion_date', e.target.value)}
                    />

                    <InputError className="mt-2" message={errors.training_completion_date} />
                </div>

                <div>
                    <InputLabel htmlFor={`lifetime_employee_number`} value="Lifetime Employee Number" />

                    <input
                        id={`lifetime_employee_number`}
                        type="text"
                        className="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"
                        value={data.lifetime_employee_number}
                        onChange={(e) => setData('lifetime_employee_number', e.target.value)}
                    />

                    <InputError className="mt-2" message={errors.lifetime_employee_number} />
                </div>

                <div>
                    <InputLabel htmlFor={`job_scope`} value="Job Scope" />

                    <input
                        id={`job_scope`}
                        type="text"
                        className="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"
                        value={data.job_scope}
                        onChange={(e) => setData('job_scope', e.target.value)}
                    />

                    <InputError className="mt-2" message={errors.job_scope} />
                </div>

                <div>
                    <InputLabel htmlFor={`organization`} value="Organization" />

                    <input
                        id={`organization`}
                        type="text"
                        className="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"
                        value={data.organization}
                        onChange={(e) => setData('organization', e.target.value)}
                    />

                    <InputError className="mt-2" message={errors.organization} />
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
