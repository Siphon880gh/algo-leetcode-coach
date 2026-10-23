## Lengths, then carry DP

1. L = number of digits of n. For each la, lb in 1 … L:
2. f = {carry 0: 1}. At position i, try a in 1 … 9 if i < la else 0, and b the same with lb; keep (a + b + carry) whose last digit equals n’s digit i.
3. Add the ways that end with carry 0.
4. Return the total.

Examples → 1, 2, 8. Checked against testing every a for n up to 1,500.

Counting unordered pairs: example 3 → 4 instead of 8.

Time: O(L³ · 81)  
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
