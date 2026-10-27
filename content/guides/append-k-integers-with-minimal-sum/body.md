## Arithmetic sums over gaps

1. `prev = 0`; for each distinct `x` ascending: `g = min(k, x − prev − 1)`; add `(prev + 1) + … + (prev + g)`; `k −= g`; `prev = x`; stop when `k = 0`.
2. If `k > 0`: add `(prev + 1) + … + (prev + k)`.

Examples → 5, 25. Checked against picking missing integers one by one on 300 random cases.

k reaches 10^8 and values 10^9, so the answer reaches about 10^17; use 64-bit and never loop number by number.

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
