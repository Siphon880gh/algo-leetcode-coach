## Three states

1. For op in {x · k, x / k rounded toward zero}:
2. A = best sum ending here, not changed yet: max(A, 0) + x.
3. B = inside the change: max(A, 0, B) + op(x).
4. C = after the change: max(B, C) + x.
5. The answer is the largest B or C seen.

Examples → 14, −1. Checked against trying every operation and subarray on 1,500 random arrays. Edge check: 10^5 values of 10^5 with k = 10^5 → 10^15, so use 64-bit integers.

Dividing negatives with floor division: example 2 → −2 instead of −1.

Time: O(n)  
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
