## Max-heap

1. Heapify `nums` as a max-heap; `score = 0`.
2. Repeat `k` times: pop `x`; `score += x`; push `ceil(x / 3)`, computed as `(x + 2) / 3`.
3. Return `score`.

Examples → 50, 17.

The score can reach 10^5 · 10^9 = 10^14, so use 64-bit. Integer `(x + 2) / 3` avoids floating-point ceilings on large values.

Time: O((n + k) log n)  
Space: O(n)

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
