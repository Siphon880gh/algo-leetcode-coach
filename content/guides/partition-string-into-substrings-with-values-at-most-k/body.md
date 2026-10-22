## Longest piece first

1. `count = 0`, `v = 0`.
2. For each digit `d`: if `d > k`, return −1. If `10v + d ≤ k`, `v = 10v + d`; else `count++`, `v = d`.
3. Return `count + 1`.

Examples → 4, −1. Checked against a DP over every cut on 400 random strings.

Making a piece longer never makes the rest harder, since the rest only shrinks. Values stay at most k ≤ 10^9 before the check, but 10v + d can reach about 10^10, so compute it in 64-bit.

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
