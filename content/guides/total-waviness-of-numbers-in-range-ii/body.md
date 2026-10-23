## Digit DP

1. calc(x): dfs(pos, p2, p1, started, tight) → (count, waviness).
2. Placing d: if two real digits precede it and p1 is above or below both p2 and d, add 1 for every number below this state.
3. Leading zeros keep started false and do not count as digits.
4. Return calc(num2) − calc(num1 − 1).

Examples → 3, 3, 2. Checked against summing part I’s count for 300 random ranges up to 10^5.

Treating leading zeros as digits: constructed check (run in code) num1 = 1, num2 = 200 → 98 instead of 53.

Time: O(D · 10³) with D ≤ 16 digits (about D · 11² · 4 states, 10 choices each)  
Space: O(D · 10²)

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
