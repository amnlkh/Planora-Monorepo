import { useState } from "react";

export default function ScheduleList() {
  const [schedules, setSchedules] = useState([
    {
      id: 1,
      subject: "Algorithms",
      time: "09:00 AM",
    },
    {
      id: 2,
      subject: "Database Systems",
      time: "01:00 PM",
    },
  ]);

  const [newSubject, setNewSubject] = useState("");
  const [newTime, setNewTime] = useState("");

  const addSchedule = () => {
    if (!newSubject || !newTime) return;

    setSchedules([
      ...schedules,
      {
        id: Date.now(),
        subject: newSubject,
        time: newTime,
      },
    ]);

    setNewSubject("");
    setNewTime("");
  };

  const deleteSchedule = (id) => {
    setSchedules(
      schedules.filter((schedule) => schedule.id !== id)
    );
  };

  return (
    <div className="min-h-screen bg-[#0F0F23] text-white p-8">

      <h1 className="text-4xl font-bold text-purple-300 mb-2">
        Study Schedule
      </h1>

      <p className="text-gray-400 mb-8">
        Organize your study sessions
      </p>

      {/* Add Schedule */}
      <div className="bg-[#1A1A35] p-6 rounded-2xl mb-8">

        <div className="flex gap-3 flex-wrap">

          <input
            type="text"
            placeholder="Subject"
            value={newSubject}
            onChange={(e) => setNewSubject(e.target.value)}
            className="flex-1 p-3 rounded-lg bg-[#0D0D1F]"
          />

          <input
            type="time"
            value={newTime}
            onChange={(e) => setNewTime(e.target.value)}
            className="p-3 rounded-lg bg-[#0D0D1F]"
          />

          <button
            onClick={addSchedule}
            className="bg-purple-500 hover:bg-purple-600 px-5 rounded-lg"
          >
            Add
          </button>

        </div>

      </div>

      {/* Schedule List */}
      <div className="space-y-4">

        {schedules.map((schedule) => (
          <div
            key={schedule.id}
            className="bg-[#1A1A35] p-5 rounded-xl flex justify-between items-center"
          >
            <div>
              <h3 className="font-semibold text-lg">
                {schedule.subject}
              </h3>

              <p className="text-gray-400">
                {schedule.time}
              </p>
            </div>

            <button
              onClick={() => deleteSchedule(schedule.id)}
              className="bg-red-500 hover:bg-red-600 px-4 py-2 rounded-lg"
            >
              Delete
            </button>

          </div>
        ))}

      </div>

    </div>
  );
}