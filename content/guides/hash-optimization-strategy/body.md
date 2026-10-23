## Tiny example

Problem: for each index `i`, is there `j < i` with `nums[j] == target - nums[i]`? (Two Sum style)

Nested loops: O(n²).

Hash set/map: while scanning left→right, query `need = target - nums[i]` in expected O(1), then insert `nums[i]`.

You trade **O(n) memory** for dropping a linear scan per index.


## How

1. Spot a repeated “have I seen X?” or “last index of X?”
2. Allocate a hash set/map
3. Replace the inner scan with a lookup; update the map as you go


## Trap

Hashing objects without proper `equals/hashCode`, then wondering why lookups miss.

**Fix:** Define equality consistently; prefer immutable keys.

**Time:** expected O(n) for a linear scan with map · **Space:** O(n)

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
