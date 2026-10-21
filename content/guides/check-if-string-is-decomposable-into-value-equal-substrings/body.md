A value-equal string consists of a single repeated character. Given a digit string, decide whether it can be split into consecutive value-equal substrings so that exactly one has length 2 and all the others have length 3. For instance, "000111000" → false, "00011111222" → true, and "011100022233" → false. _(Restated from memory; limits and examples may differ slightly from the official statement.)_

## Per-run remainder

1. For each maximal run of equal characters with length `L`:
   - `L % 3 == 1` → false;
   - `L % 3 == 2` → count one length-2 piece.
2. Return whether exactly one such run exists.

Constructed checks (verified against a search over all splits on random binary strings): the three cases above → false, true, false.

Pieces never cross run boundaries since each piece is one repeated character. Zero length-2 pieces is also a failure: the statement requires exactly one.

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
