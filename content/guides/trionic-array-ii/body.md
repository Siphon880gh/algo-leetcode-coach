## Phases

For each i ≥ 1:
- a[i] > a[i − 1]: up1 = max(up1, a[i − 1]) + a[i]; up2 = max(up2, down) + a[i]; down = −∞.
- a[i] < a[i − 1]: down = max(down, up1) + a[i]; up1 = up2 = −∞.
- equal: all −∞.

Answer the largest up2 seen.

Examples → −4, 14. Checked against trying every subarray on 2,000 random arrays.

Letting the first rise be a single element: example 1 → −2 instead of −4.

Time: O(n)  
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
