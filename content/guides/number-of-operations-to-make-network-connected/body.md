## Count components

1. If `len(connections) < n − 1`, return −1.
2. Union every cable; start with `n` components and subtract 1 per successful union.
3. Return `components − 1`.

`n = 4`, `[[0,1],[0,2],[1,2]]` → 1. `n = 6` with 5 cables → 2. `n = 6` with 4 cables → −1.

Do not count redundant cables and compare them with the components; once there are at least `n − 1` cables, enough are always redundant. Do not forget isolated computers; each is its own component.

Time: O((n + E) · α(n))  
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
