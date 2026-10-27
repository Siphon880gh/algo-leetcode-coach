## One pass, one buffer

1. `j = 0`, `out = []`.
2. For each index `i`: if `j < len(spaces)` and `spaces[j] == i`, append a space and `j += 1`. Append `s[i]`.
3. Return `join(out)`.

Examples → `Leetcode Helps Me Learn`, `i code in py thon`, ` s p a c i n g`.

Building a list and joining once avoids quadratic string concatenation; inserting into the string at each index would also shift the later indices.

Time: O(n + m)  
Space: O(n + m)

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
