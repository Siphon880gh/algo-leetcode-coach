## Count steps as you water

1. `water = capacity`, `steps = 0`.
2. For plant `i`: if `water < plants[i]`, add `2 · i` and refill. Then `water −= plants[i]`, `steps += 1`.
3. Return `steps`.

Examples → 14, 30, 49. Checked against tracking the position step by step on random inputs.

Standing at plant `i − 1`, the river at −1 is `i` steps away, and coming back to `i − 1` is another `i`; the single step onto plant `i` is the same as without a refill.

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
