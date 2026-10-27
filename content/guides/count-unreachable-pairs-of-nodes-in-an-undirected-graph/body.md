## Pairs across components

1. Union every edge; count the size of each root.
2. `seen = 0`, `ans = 0`; for each size `s`: `ans += s · seen`, `seen += s`.
3. Return `ans`.

Examples → 0, 14.

Each unordered pair across two components is counted once, when the later component is added. Equivalently `ans = (n² − Σ s²) / 2`. With n = 10^5 the answer reaches about 5 · 10^9, so use 64-bit.

Time: O(n + E · α(n))  
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
