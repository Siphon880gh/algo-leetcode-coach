## Locate

1. k ≤ 9 → k.
2. k −= 9. For d = 2, 3, …: the group has 9 · 10^(d − 2) blocks of 10d digits; skip it while k is larger.
3. b = 10^(d − 2) + (k − 1) / (10d); pos = (k − 1) mod 10d; i = pos / d.
4. num = 10b + i for even b, 10b + 9 − i for odd b. Return digit pos mod d of num.

Examples → 4, 7, 9. Matched the built string for every k up to 138,889.

Ignoring the reversed blocks: example 2 → 2 instead of 7.

Time: O(log k)  
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
