## Checks before effects

- `valid(a) = 1 ≤ a ≤ n`.
- `transfer(a, b, m)`: valid a and b, `bal[a] ≥ m` → move, true; else false.
- `deposit(a, m)`: valid a → add, true.
- `withdraw(a, m)`: valid a and `bal[a] ≥ m` → subtract, true.

Example 1 → `true, true, true, false, false`.

Accounts are 1-indexed while the array is 0-indexed. Check the destination in a transfer before subtracting, or a failed transfer would still debit the source. Balances need 64-bit.

Time: O(1) per operation  
Space: O(n)

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
