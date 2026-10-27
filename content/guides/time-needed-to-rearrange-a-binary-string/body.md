## Finish time of the last 1

1. `zeros = 0`, `t = 0`.
2. For each character: if 0, `zeros++`; else if `zeros > 0`, `t = max(t + 1, zeros)`.
3. Return `t`.

Examples → 4, 0. Checked against simulating the replacements on 500 random strings.

A 1 moves left once per second until it passes every zero before it, unless the 1 in front blocks it, which costs one extra second. The simulation is O(n²) and also passes for length 1000.

Time: O(n)  
Space: O(1)

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
