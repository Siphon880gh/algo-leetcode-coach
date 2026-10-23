## Two parts

1. If n = 0, return 1.
2. t = 2 (for 0 and 1), plus 2^(⌈l / 2⌉ − 1) for each length l from 2 to L − 1.
3. If L ≥ 2: h = ⌈L / 2⌉, p = the top h bits of n. Add p − 2^(h − 1); mirror p into a palindrome of length L and add 1 if it is ≤ n.
4. Return t.

Examples → 6, 1. Checked against testing every number up to 5,000 and 200 random n up to 10^6.

Forgetting that 0 counts: n = 9 → 5 instead of 6.

Time: O(log n)  
Space: O(log n)

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
