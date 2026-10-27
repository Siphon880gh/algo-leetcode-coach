## Record changes, not copies

- Constructor: `hist[i] = [(0, 0)]` for each index; `snapId = 0`.
- `set(i, v)`: if `hist[i][-1]` has id `snapId`, overwrite its value; else append `(snapId, v)`.
- `snap()`: `snapId += 1`; return `snapId − 1`.
- `get(i, s)`: binary search `hist[i]` for the last entry with id ≤ `s`; return its value.

Each `set` costs O(1) and each `get` O(log changes).

Do not copy the whole array on `snap`; with many snapshots that is O(length · snaps). Do not append duplicates for repeated sets in the same snapshot; overwrite the last entry.

Time: O(1) set and snap, O(log k) get  
Space: O(length + sets)

> [!ui-builder] Mini game
> INPUT_TOPIC: Theory or problem
> INPUT_SLUG: Folder slug (kebab-case)
> PROMPT:
> Use the harness skill at .agents/skills/harness to create a mini-game in this Leetcode Practice Coach IDE app that teaches [INPUT_TOPIC]. Place it under content/games/[INPUT_SLUG]/. Follow meta.php + index.html. Use .agents/skills/game-development-sickn33 for web/2d craft if needed.

> [!ui-builder] Step-by-step
> INPUT_TOPIC: Theory or problem
> INPUT_SLUG: Folder slug (kebab-case)
> PROMPT:
> Use the harness skill at .agents/skills/harness to create a step-by-step session for [INPUT_TOPIC] under content/coaching/[INPUT_SLUG]/. Include branching choices with clear labels, at least one wrong-path leaf with rewind_to, and a success leaf. Follow the tree.php contract so Step back and the Path visualizer work.
