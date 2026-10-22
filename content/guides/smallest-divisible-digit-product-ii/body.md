## Prefix, bump, fill

1. Factor t = 2^a 3^b 5^c 7^d, else "-1". need[i] = exponents still missing after num[0 … i − 1] (only up to the first 0).
2. If num is zero-free and need[n] = 0, return num.
3. For i from the last allowed position down, d from num[i] + 1 to 9: fill = fewest digits covering need[i] minus d (7s, 5s, 9s, 8s, then 6, 4, 3, 2), sorted. If fill fits in the n − 1 − i places, return prefix + d + 1s + fill.
4. Otherwise 1s + fill for t, with length max(n + 1, |fill|).

Examples → 1488, 12355, -1. Checked against counting upward on 2,000 random cases.

Allowing zeros (product 0): example 1 → 1240 instead of 1488.

Time: O(n · 9)  
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
