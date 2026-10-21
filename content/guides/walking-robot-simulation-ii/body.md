## Index into the loop

1. Build the border once: bottom row East, right column North, top row West, left column South; length `2(w + h) − 4`.
2. Cell 0 is `(0, 0)`, stored with direction South (it is entered from above).
3. `step(k)`: `i = (i + k) mod len`, `moved = true`.
4. `getPos()` = cell `i`; `getDir()` = `East` if never moved, else the stored direction.

Example 1 → `[4,0]`, East, `[1,2]`, West. Checked against step-by-step simulation on random grids.

Steps can be up to 10^5 per call, so walking them one by one is too slow; the modulus jumps there directly. The only subtle case is the start: before any move the robot faces East, after a full lap it faces South.

Time: O(w + h) setup, O(1) per call  
Space: O(w + h)

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
