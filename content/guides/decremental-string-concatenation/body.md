## Ends only

1. `dp[(first, last)] = length` for words[0].
2. For each next word w and state (a, b, L): appending gives `(a, last of w)` with `L + |w| − [b = first of w]`; prepending gives `(first of w, b)` with `L + |w| − [last of w = a]`. Keep the minimum per state.
3. Return the minimum over states.

Examples → 4, 2, 6. Checked against building every join order on 300 random small cases.

Picking the shorter join at each step is not enough: [a, b, ab] with ties going to the first option → 4 instead of 3, because ba sets up a later overlap that ab does not.

Time: O(n · 26²)  
Space: O(26²)

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
