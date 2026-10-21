## Partition, not sort

`i = 0`, `j = n − 1`. While `i < j`:

- If `nums[i]` is even, `i += 1`.
- Else if `nums[j]` is odd, `j −= 1`.
- Else swap `nums[i]` and `nums[j]`.

Return `nums`.

This is the partition step of quicksort with "even" as the pivot test. Any order within the even and odd parts is accepted.

A write pointer also works: walk once and swap each even number to position `w`, then `w += 1`.

Do not sort by value; the problem only asks for evens before odds. Do not build two lists unless extra space is fine.

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
