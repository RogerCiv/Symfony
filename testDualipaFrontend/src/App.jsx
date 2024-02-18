import { useEffect } from "react";


function App() {
  const fetchData = async () => {
    try {
      const resp = await fetch('/api/users');
      if (!resp.ok) {
        throw new Error(`HTTP error! Status: ${resp.status}`);
      }
      const data = await resp.json();
      console.log(data);
    } catch (error) {
      console.error("Error fetching data:", error);
    }
  }

  useEffect(() => {
    fetchData();
  }, []);

  return (
    <>

    </>
  )
}

export default App
