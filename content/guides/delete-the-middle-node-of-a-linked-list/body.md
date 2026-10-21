## Land before the middle

1. If `head.next` is null, return null.
2. `slow = head`, `fast = head.next.next`.
3. While `fast` and `fast.next`: `slow = slow.next`, `fast = fast.next.next`.
4. `slow.next = slow.next.next`; return `head`.

Examples → `[1,3,4,1,2,6]`, `[1,2,4]`, `[2]`.

The middle is index `⌊n / 2⌋`; giving `fast` a head start of two nodes leaves `slow` at index `⌊n / 2⌋ − 1`, the node whose `next` must change.

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
