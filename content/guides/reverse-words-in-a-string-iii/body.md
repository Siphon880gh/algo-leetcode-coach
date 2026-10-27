## Word by word

`" ".join(w[::-1] for w in s.split(" "))`.

In place on a char array: walk `i`; find the end `j` of the word (next space or the end); swap from both ends of `[i, j − 1]`; set `i = j + 1`.

Reverse Words in a String (151) reverses the order of the words instead, and also cleans up extra spaces.

Do not reverse the whole string — that also reverses the word order. Do not split on any whitespace if you must keep exact spacing (here it is single spaces, so both work).

Time: O(n)  
Space: O(n) for the result

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
