## Digit DP

1. `f(N)`: state (i, balance, rem, tight, started); leading zeros do not change the balance.
2. Count numbers that end started, with balance 0 and rem 0.
3. Return `f(high) − f(low − 1)`.

Examples → 2, 1, 0. Checked against direct testing on 100 random ranges up to 3000.

Leading zeros must not count as even digits, or 7 would look like 07 and be balanced. There are about 10 · 20 · 20 · 2 · 2 states, tiny for 10^9.

Time: O(10 · 20 · k · 10)  
Space: O(10 · 20 · k)

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
