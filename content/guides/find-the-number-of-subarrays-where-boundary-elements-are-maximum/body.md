## Stack of equal runs

1. For each x: pop while top value < x. If top value = x, count += 1; else push (x, 1).
2. ans += top count.

Examples → 6, 6, 1. Checked against testing every subarray on 500 random arrays.

A larger value between two equal ones breaks the pair: counting all equal pairs gives [3, 4, 3] → 4 instead of 3. The answer reaches n(n + 1)/2 ≈ 5 · 10^9; use 64-bit.

Time: O(n)  
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
