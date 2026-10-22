## Running GCD per start

1. For each `i`: `g = 0`.
2. For `j = i …`: `g = gcd(g, nums[j])`; if `g mod k ≠ 0`, stop; if `g = k`, `count++`.
3. Return `count`.

Examples → 4, 0.

n ≤ 1000 makes about 5 · 10^5 pairs, each with one gcd. A running GCD only keeps or loses divisors, so once k stops dividing it, no longer subarray from i can reach k.

Time: O(n² log V)  
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
