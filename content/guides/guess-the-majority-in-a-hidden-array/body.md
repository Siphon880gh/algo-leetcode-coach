A hidden binary array is accessible only through a reader that returns its length and, for four distinct indices, a value describing how evenly their elements split (as the statement specifies: all equal, three-to-one, or two-to-two). Return any index holding the majority value, or −1 if there is a tie, within the call limit the statement gives. _(Restated from memory; limits and examples may differ slightly from the official statement.)_

## Same-as-0 classification

1. `base = query(0,1,2,3)`. For `i ≥ 4`: `query(1,2,3,i) == base` means `nums[i] == nums[0]`.
2. For indices 1, 2, 3: compare `query(0,2,3,4)`, `query(0,1,3,4)`, `query(0,1,2,4)` against `query(1,2,3,4)` (the quadruple without 0 but with 4); equal means the swapped index matches 0.
3. Count same vs different; return 0 or any different index for the majority, −1 on a tie.

For instance, with `[0,0,1,0,1,1,1,1]` the 1s win and any index holding a 1 is accepted.

Do not compare indices pairwise with many queries; n − 1 queries plus a constant are enough.

Time: O(n) queries  
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
