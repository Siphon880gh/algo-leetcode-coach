## Join or stream

1. Simple: `"".join(word1) == "".join(word2)`.
2. O(1) extra: pointers `(i, a)` and `(j, b)`; compare characters, advance within words and roll over to the next word; both must finish together.

`["ab","c"]`, `["a","bc"]` → true. `["a","cb"]`, `["ab","c"]` → false. `["abc","d","defg"]`, `["abcddefg"]` → true.

Total length is at most 1000, so joining is fine.

Time: O(L)  
Space: O(L) joined, O(1) streamed

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
