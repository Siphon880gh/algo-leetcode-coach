## Gap of k

1. `first` = k-th node (k − 1 steps from head).
2. `fast = first`, `second = head`; while `fast.next`: advance both.
3. Swap `first.val` and `second.val`.

`[1,2,3,4,5]`, k = 2 → `[1,4,3,2,5]`. Example 2, k = 5 → `[7,9,6,6,8,7,3,0,9,5]`.

Swapping values is accepted here; swapping nodes needs care when they are adjacent or equal.

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
