Same game as part I: split word into numFriends non-empty pieces in every possible way and return the lexicographically largest piece that ever appears. This version allows a much longer word. Limits are in the official statement. _(Restated from memory; limits and examples may differ slightly from the official statement.)_

## Largest suffix

This assumes the word is too long for comparing a piece from every start; check the official limits.

1. If numFriends = 1, return word.
2. i, j, k scan: compare word[i + k] and word[j + k]; on equal, k += 1; if word[i + k] < word[j + k], i = max(i + k + 1, j), j = i + 1; else j += k + 1; reset k.
3. Answer word[i : i + n − numFriends + 1].

Constructed checks (run in code): dbca, 2 → dbc; gggg, 4 → g. Checked against every split on 600 random cases.

Cutting the word itself instead of the largest suffix: bcad, numFriends = 2 → bca instead of d.

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
