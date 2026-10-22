## Count orders

1. Gaps: before the first sick, after the last, and between neighbours.
2. `ans = total! / Π gap!` using factorials and modular inverses (Fermat).
3. Multiply by `2^(L − 1)` for each inner gap with L > 0.
4. Return ans mod 10^9 + 7.

Examples → 4, 3. Checked against listing every sequence for n ≤ 8 on 300 random inputs.

Edge gaps grow from one side only. Without the inner-gap factor, example 1 → 1 instead of 4.

Time: O(n + log M)  
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
