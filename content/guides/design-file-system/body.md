Design a file system where `createPath(path, value)` creates a new path with a value and returns true, or returns false if the path already exists or its parent does not exist; `get(path)` returns the value or −1. For instance, after `createPath("/a", 1)` returns true, `get("/a")` returns 1, while `createPath("/c/d", 1)` returns false because `/c` is missing. _(Restated from memory; limits and examples may differ slightly from the official statement.)_

## Map of full paths

- `createPath(path, value)`: if `path` is in the map, return false. `parent = path[:path.rfind("/")]`. If `parent` is not empty and not in the map, return false. Otherwise store it and return true.
- `get(path)`: return the stored value, or −1.

A trie of path components also works and saves memory for long shared prefixes, but the dictionary is simpler.

Do not create missing parents automatically; the call must fail. Do not overwrite an existing path.

Time: O(len(path)) per call  
Space: O(total path length)

> [!ui-builder] Mini game
> INPUT_TOPIC: Theory or problem
> INPUT_SLUG: Folder slug (kebab-case)
> PROMPT:
> Use the harness skill at .agents/skills/harness to create a mini-game in this Algo Learning IDE app that teaches [INPUT_TOPIC]. Place it under content/games/[INPUT_SLUG]/. Follow meta.php + index.html. Use .agents/skills/game-development-sickn33 for web/2d craft if needed.

> [!ui-builder] Step-by-step
> INPUT_TOPIC: Theory or problem
> INPUT_SLUG: Folder slug (kebab-case)
> PROMPT:
> Use the harness skill at .agents/skills/harness to create a step-by-step session for [INPUT_TOPIC] under content/coaching/[INPUT_SLUG]/. Include branching choices with clear labels, at least one wrong-path leaf with rewind_to, and a success leaf. Follow the tree.php contract so Step back and the Path visualizer work.
