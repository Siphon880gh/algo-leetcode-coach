## Signatures, not permutations

1. Compute `sig(n)`: the count of each digit, or the sorted digit string.
2. For `i` in 0 … 29 (2²⁹ < 10⁹ < 2³⁰), if `sig(1 << i) == sig(n)`, return true.

Return false.

A leading zero is never an issue: powers of two have no leading zeros, and matching counts means you can order the digits like the power.

Do not generate all permutations of `n`; with 10 digits that is millions. Do not compare only digit sums; different digit multisets can share a sum.

Time: O(30 · d), d = number of digits  
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
