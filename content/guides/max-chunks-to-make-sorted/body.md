## A prefix holds 0 … i exactly when its max is i

Scan with `mx = max(mx, arr[i])`. If `mx == i`, the prefix `arr[0..i]` contains exactly the values `0 … i`, so sorting it puts them in their final places; count a chunk.

Each such position is a valid cut, and every valid cut is such a position, so the count is the maximum number of chunks.

This relies on the values being a permutation of `0 … n − 1`. For arbitrary values with duplicates, use the stack or prefix-max/suffix-min method of problem 768.

Do not sort and compare whole prefixes; the running max is enough. Do not test `arr[i] == i` instead of the running max; `[1,2,0,3]` passes that test only at index 3, but the answer is 2 (cuts after index 2 and 3).

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
