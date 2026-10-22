## Owner array

1. `mem = [0] · n`.
2. `allocate(size, mID)`: scan left to right, counting consecutive free cells; when the run reaches `size`, fill it with `mID` and return its first index. Return −1 after the scan.
3. `freeMemory(mID)`: set every cell equal to `mID` to 0 and return how many there were.

Example → [null, 0, 1, 2, 1, 3, 1, 6, 3, −1, 0].

Reset the run count on every used cell. An mID can own several blocks, so freeing must clear all of them. With n ≤ 1000 and at most 1000 calls, O(n) per call is about 10^6 steps.

Time: O(n) per call  
Space: O(n)

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
