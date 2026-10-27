## Enumerate the smaller set

1. For length `L = 1, 2, …`: for each first half `f` with `ceil(L / 2)` digits in increasing order, mirror it into a palindrome `p`.
2. If `p` is a palindrome in base `k`, take it.
3. Stop after `n` numbers and return their sum.

Examples → 25, 499, 20379000.

Mirroring the first half produces palindromes of one length in increasing order, and shorter lengths are smaller, so the numbers come out sorted. With n ≤ 30 the search tries fewer than 10^6 halves (about 7.5 · 10^5 for k = 7, the worst base).

Time: about O(H · log p) for H halves tried  
Space: O(1)

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
