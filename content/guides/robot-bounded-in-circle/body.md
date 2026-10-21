## Four rounds at most

Start at `(0, 0)` facing north, with directions `[(0,1), (1,0), (0,−1), (−1,0)]` and index `d = 0`.

- `G`: add direction `d` to the position.
- `L`: `d = (d + 3) % 4`.
- `R`: `d = (d + 1) % 4`.

Return `position == (0, 0) or d != 0`.

If the robot faces another direction, it returns to the start within 4 rounds (2 if it faces south). If it faces north and moved, every round adds the same shift.

Do not simulate many rounds and hope; the one-round test is exact. Do not mix up left and right turns in the direction array.

Time: O(n)  
Space: O(1)

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
