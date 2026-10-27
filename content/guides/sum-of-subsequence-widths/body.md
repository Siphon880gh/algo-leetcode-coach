## Contribution per element

A subsequence's width is its max minus its min, which does not depend on order, so sort `nums`.

In sorted order, `a[i]` is the maximum of every subsequence built from it plus any subset of the `i` smaller elements: `2^i` of them. It is the minimum of `2^(n − 1 − i)` of them.

`answer = Σ a[i] · (2^i − 2^(n − 1 − i))` mod 10⁹ + 7.

Precompute powers of 2 mod 10⁹ + 7. Since the difference can be negative, add the modulus before taking `%` in languages where `%` can return a negative.

Equal values are fine: ties are broken by sorted position, and each subsequence is still counted once.

Do not enumerate subsequences; there are 2ⁿ. Do not forget the minimum side; counting only maxima gives the sum of maxima, not of widths.

Time: O(n log n)  
Space: O(n)

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
