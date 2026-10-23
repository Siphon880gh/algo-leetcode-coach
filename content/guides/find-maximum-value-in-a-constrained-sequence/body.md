## Forward and backward

1. cap[0] = 0; cap[idx] = maxVal; others unlimited.
2. Left to right: a[i] = min(cap[i], a[i − 1] + diff[i − 1]).
3. Right to left: a[i] = min(a[i], a[i + 1] + diff[i]).
4. Return max(a).

Examples → 6, 12. Checked against trying every sequence on 800 small random cases.

Skipping the backward pass: example 1 → 12 instead of 6.

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
