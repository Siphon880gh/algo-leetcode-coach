## Sweep queries left to right

1. Sort intervals by `left`; iterate distinct queries in sorted order.
2. Push `(size, right)` for intervals with `left ≤ q`.
3. Pop while the top's `right < q`.
4. Answer = top size, or −1; map back to the original order.

Example 1 → `[3,3,1,4]`. Example 2 → `[2,-1,4,6]`.

Lazy deletion is safe: an interval ending before q also ends before every later query.

Time: O((n + q) log n)  
Space: O(n + q)

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
