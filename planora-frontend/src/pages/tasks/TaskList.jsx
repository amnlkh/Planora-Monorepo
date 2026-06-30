import { useState } from "react";

export default function TaskList() {
  const [tasks, setTasks] = useState([
    {
      id: 1,
      title: "Human Computer Interaction Essay",
      priority: "High",
    },
    {
      id: 2,
      title: "Algorithm Lab Report",
      priority: "Medium",
    },
    {
      id: 3,
      title: "Weekly Reading Quiz",
      priority: "Low",
    },
  ]);

  const [newTask, setNewTask] = useState("");

  const [editingTask, setEditingTask] = useState(null);
  const [editedTitle, setEditedTitle] = useState("");

  const addTask = () => {
    if (!newTask.trim()) return;

    setTasks([
      ...tasks,
      {
        id: Date.now(),
        title: newTask,
        priority: "Medium",
      },
    ]);

    setNewTask("");
  };

  const deleteTask = (id) => {
    setTasks(tasks.filter((task) => task.id !== id));
  };

  const openEditModal = (task) => {
    setEditingTask(task);
    setEditedTitle(task.title);
  };

  const saveEdit = () => {
    setTasks(
      tasks.map((task) =>
        task.id === editingTask.id
          ? { ...task, title: editedTitle }
          : task
      )
    );

    setEditingTask(null);
  };

  return (
    <div className="min-h-screen bg-[#0F0F23] text-white p-8">

      {/* Header */}
      <div className="mb-8">

        <h1 className="text-4xl font-bold text-purple-300">
          Task Management
        </h1>

        <p className="text-gray-400">
          Manage your academic tasks
        </p>

      </div>

      {/* Add Task */}
      <div className="bg-[#1A1A35] p-6 rounded-2xl mb-8 border border-white/5">

        <div className="flex gap-3">

          <input
            type="text"
            placeholder="Enter new task..."
            value={newTask}
            onChange={(e) => setNewTask(e.target.value)}
            className="flex-1 p-3 rounded-lg bg-[#0D0D1F] text-white outline-none border border-transparent focus:border-purple-500"
          />

          <button
            onClick={addTask}
            className="bg-purple-500 hover:bg-purple-600 px-5 rounded-lg transition"
          >
            Add
          </button>

        </div>

      </div>

      {/* Task List */}
      <div className="space-y-4">

        {tasks.map((task) => (
          <div
            key={task.id}
            className="bg-[#1A1A35] rounded-2xl p-5 border border-white/5 flex justify-between items-center"
          >

            <div>

              <h3 className="font-semibold text-lg">
                {task.title}
              </h3>

              <div className="mt-3">

                {task.priority === "High" && (
                  <span className="bg-red-500/20 text-red-400 px-3 py-1 rounded-full text-sm">
                    High
                  </span>
                )}

                {task.priority === "Medium" && (
                  <span className="bg-yellow-500/20 text-yellow-400 px-3 py-1 rounded-full text-sm">
                    Medium
                  </span>
                )}

                {task.priority === "Low" && (
                  <span className="bg-green-500/20 text-green-400 px-3 py-1 rounded-full text-sm">
                    Low
                  </span>
                )}

              </div>

            </div>

            <div className="flex gap-3">

              <button
                onClick={() => openEditModal(task)}
                className="bg-blue-500 hover:bg-blue-600 px-4 py-2 rounded-lg transition"
              >
                Edit
              </button>

              <button
                onClick={() => deleteTask(task.id)}
                className="bg-red-500 hover:bg-red-600 px-4 py-2 rounded-lg transition"
              >
                Delete
              </button>

            </div>

          </div>
        ))}

      </div>

      {/* Edit Modal */}
      {editingTask && (
        <div className="fixed inset-0 bg-black/60 flex items-center justify-center">

          <div className="bg-[#1A1A35] p-6 rounded-2xl w-full max-w-md border border-white/10">

            <h2 className="text-2xl font-bold text-purple-300 mb-4">
              Edit Task
            </h2>

            <input
              type="text"
              value={editedTitle}
              onChange={(e) => setEditedTitle(e.target.value)}
              className="w-full p-3 rounded-lg bg-[#0D0D1F] text-white mb-4 outline-none border border-transparent focus:border-purple-500"
            />

            <div className="flex justify-end gap-3">

              <button
                onClick={() => setEditingTask(null)}
                className="bg-gray-600 hover:bg-gray-700 px-4 py-2 rounded-lg"
              >
                Cancel
              </button>

              <button
                onClick={saveEdit}
                className="bg-purple-500 hover:bg-purple-600 px-4 py-2 rounded-lg"
              >
                Save
              </button>

            </div>

          </div>

        </div>
      )}

    </div>
  );
}