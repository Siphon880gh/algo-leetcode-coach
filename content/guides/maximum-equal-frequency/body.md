## Three valid shapes

For each prefix length `L` (after adding `x`, updating `cnt` and `freq`, and `mx` = max count), `L` is valid if:

1. `mx == 1` (remove any one element), or
2. `freq[mx] · mx + 1 == L` (one extra value occurs once; remove it), or
3. `freq[mx − 1] · (mx − 1) + mx == L` (one value occurs once more than the rest; remove one of its copies).

Return the largest valid `L`.

`[2,2,1,1,5,3,3,5]` → 7. `[1,1,1,2,2,2,3,3,3,4,4,4,5]` → 13.

Case 3 also covers a prefix with a single distinct value (`freq[mx − 1]` is 0 and `mx == L`).

Do not try deleting each element per prefix; that is O(n²). Do not forget to decrement `freq` at the old count before incrementing.

Time: O(n)  
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
