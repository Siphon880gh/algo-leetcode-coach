## Low bits first

1. `ops = 0`.
2. While `n > 0`: if the low two bits are 11, `n += 1`, `ops++`; else if the low bit is 1, `n −= 1`, `ops++`; else `n >>= 1`.
3. Return `ops`.

Examples → 3, 3. Checked against a breadth-first search for every n below 3000 that needs at most 4 operations.

Adding 1 to ...011 clears both 1s and leaves one carry bit, so a run of length r costs 2 instead of r. A single 1 followed by 0 costs 1 either way.

Time: O(log n)  
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
