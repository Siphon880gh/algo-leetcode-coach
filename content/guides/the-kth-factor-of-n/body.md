## O(√n)

1. For `i` from 1 while `i · i ≤ n`: if `i` divides `n`, decrement `k`; return `i` at 0. Remember the small divisors.
2. Walk the small divisors backwards, skipping `√n` if `n` is a square; each gives `n / i`, decrement `k`, return at 0.
3. Return −1.

n = 12, k = 3 → 3. n = 7, k = 2 → 7. n = 4, k = 4 → −1.

Do not count √n twice for perfect squares. A plain O(n) loop also passes for n ≤ 1000.

Time: O(√n)  
Space: O(√n)

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
