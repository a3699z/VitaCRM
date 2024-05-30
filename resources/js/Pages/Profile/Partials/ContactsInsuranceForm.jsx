import InputError from '@/Components/InputError';
import InputLabel from '@/Components/InputLabel';
import PrimaryButton from '@/Components/PrimaryButton';
import { Link, useForm, usePage } from '@inertiajs/react';

export default function ContactsInsuranceForm({ className = '' }) {
    const user = usePage().props.auth.user;
    console.log(user.available_dates);

    const { data, setData, patch, errors, processing, recentlySuccessful } = useForm({
        place_residence: user.place_residence ? user.place_residence : '',
        telephone: user.telephone ? user.telephone : '',
        mobile: user.mobile ? user.mobile : '',
        email: user.email ? user.email : '',
        health_insurance: user.health_insurance ? user.health_insurance : '',
    });


    // console.log(dates)

    const submit = (e) => {
        e.preventDefault();

        patch(route('contacts.update'));
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
                    <InputLabel htmlFor={`place_residence`} value="Place of Residence" />

                    <input
                        id={`place_residence`}
                        type="text"
                        className="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"
                        value={data.place_residence}
                        onChange={(e) => setData('place_residence', e.target.value)}
                    />

                    <InputError className="mt-2" message={errors.place_residence} />
                </div>

                <div>
                    <InputLabel htmlFor={`telephone`} value="Telephone" />

                    <input
                        id={`telephone`}
                        type="text"
                        className="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"
                        value={data.telephone}
                        onChange={(e) => setData('telephone', e.target.value)}
                    />

                    <InputError className="mt-2" message={errors.telephone} />
                </div>

                <div>
                    <InputLabel htmlFor={`mobile`} value="Mobile" />

                    <input
                        id={`mobile`}
                        type="text"
                        className="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"
                        value={data.mobile}
                        onChange={(e) => setData('mobile', e.target.value)}
                    />

                    <InputError className="mt-2" message={errors.mobile} />
                </div>

                <div>
                    <InputLabel htmlFor={`email`} value="Email" />

                    <input
                        id={`email`}
                        type="text"
                        className="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"
                        value={data.email}
                        onChange={(e) => setData('email', e.target.value)}
                    />

                    <InputError className="mt-2" message={errors.email} />
                </div>

                <div>
                    <InputLabel htmlFor={`health_insurance`} value="Health Insurance" />

                    <input
                        id={`health_insurance`}
                        type="text"
                        className="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"
                        value={data.health_insurance}
                        onChange={(e) => setData('health_insurance', e.target.value)}
                    />

                    <InputError className="mt-2" message={errors.health_insurance} />
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
