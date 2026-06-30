import { useState } from "react";

export default function Holidays() {

  const [holidays] = useState([
    {
      id: 1,
      name: "New Year's Day",
      date: "2026-01-01",
    },
    {
      id: 2,
      name: "Isra Mi'raj",
      date: "2026-01-16",
    },
    {
      id: 3,
      name: "Independence Day",
      date: "2026-08-17",
    },
  ]);

  return (
    <div className="min-h-screen bg-[#0F0F23] text-white p-8">

      <h1 className="text-4xl font-bold text-purple-300 mb-2">
        National Holidays
      </h1>

      <p className="text-gray-400 mb-8">
        Indonesian Public Holidays
      </p>

      <div className="space-y-4">

        {holidays.map((holiday) => (
          <div
            key={holiday.id}
            className="bg-[#1A1A35] p-5 rounded-xl"
          >

            <h3 className="font-semibold text-lg">
              {holiday.name}
            </h3>

            <p className="text-gray-400">
              {holiday.date}
            </p>

          </div>
        ))}

      </div>

    </div>
  );
}